<?php
/**
 * MinusX - fixes files that shouldn't have an executable bit
 * Copyright (C) 2017 Kunal Mehta <legoktm@member.fsf.org>
 *
 * @license GPL-2.0-or-later
 *
 * @file
 */

namespace MediaWiki\MinusX;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixCommand extends CheckCommand {

	/**
	 * Initialize command
	 */
	protected function configure() {
		$this->setName( 'fix' )
			->setDescription( 'Removes executable bit from files that shouldn\'t have it' )
			->addArgument(
				'path',
				InputArgument::REQUIRED,
				'Path to directory to fix'
			);
	}

	/**
	 * Run!
	 *
	 * @param InputInterface $input Input
	 * @param OutputInterface $output Output
	 *
	 * @return int Status code
	 */
	protected function execute( InputInterface $input, OutputInterface $output ): int {
		$this->output = $output;
		$this->input = $input;
		$path = $this->setup();
		if ( is_int( $path ) ) {
			return $path;
		}
		$err = $this->loadConfig( $path );
		if ( is_int( $err ) ) {
			return $err;
		}

		$output->writeln( "Fixing $path..." );
		$bad = $this->checkPath( $path );
		$output->write( "\n" );
		if ( $bad ) {
			foreach ( $bad as $file ) {
				$this->minusX( $file->getPathname() );
				$output->writeln( "chmod a-x {$file->getPathname()}" );
			}
		} else {
			$output->writeln( 'All good!' );
		}

		return 0;
	}

	/**
	 * Remove executable bit from file
	 *
	 * @param string $filepath File
	 */
	protected function minusX( string $filepath ) {
		chmod( $filepath, fileperms( $filepath ) & ~0111 );
	}

}
