# Google Sitemap Feed Generator

A simple tool to generate a google sitemap

## Requirements

* PHP 5.2+
* ZenCart 1.5+

## Installation

1 upload the folder to your catalog directory
2 Edit config.php and change the settings 
3 Setup a cron with the following
<pre><code>0  1 * * * php /home/bellastoychest1/bellastoychest.com/google_sitemap/generate.php 2>&1 > /dev/null</code></pre>
4 Make the feeds directory writeable
<pre><code>chmod 777 feeds</code></pre>

## LICENSE

### Gooogle Sitemap Feed Generator

Copyright (c) 2012 Jonathan Bradley

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.