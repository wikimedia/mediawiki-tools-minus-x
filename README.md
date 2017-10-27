MinusX
======

MinusX is a utility that finds files that shouldn't have a
[UNIX executable mode](https://en.wikipedia.org/wiki/Modes_(Unix)).

Files that are marked as executable must either have a MIME type of
`application/x-executable` or `application/x-sharedlib`, or start with
a [shebang](https://en.wikipedia.org/wiki/Shebang_(Unix)).

It can be installed via composer:

`composer require mediawiki/minus-x --dev`

Usage:

`minus-x check .`

And to automatically fix errors:

`minus-x fix .`


If you need to whitelist a specific file, create a `.minus-x.json` in
the repository root:

```
{
	"ignore": [
		"./bin/executable"
	]
}
```


MinusX is licensed under the terms of the GPL, v3 or later. See COPYING
for more details.
