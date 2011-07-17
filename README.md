Copyright (c) 2011 Michael Crosby crosbymichael.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

There are two parsers, one for CSV to XML and one for CSV to JSON.

JSON performance is 1.15sec for 3493 rows.
XML performance is 1.32sec for 3493 rows.

You can pass different document separators:

    c = comma
	fs = forward slash
	bs = back slash
	s = space
	default is comma

Separators are passed in by a get of "sep"
URL to the csv file is pass by a get of "url"

    http://urltoyourhost.com/csvJSON.php?sep=c&url=http://ichart.finance.yahoo.com/table.csv?s=GOOG&d=6&e=17&f=2011&g=d&a=7&b=19&c=2004&ignore=.csv


