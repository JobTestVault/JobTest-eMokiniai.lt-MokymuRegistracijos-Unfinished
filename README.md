# What is this?

A simple courses registration system in Lithuanian written in Symfony framework.

<img src="https://raw.githubusercontent.com/MekDrop/JobTest-eMokiniai.lt-MokymuRegistracijos-Unfinished/master/screenshot.png" alt="Screenshot" />

# How to install?

You can clone this repository and in your command line write `vagrant up` (for this command to work you need have [vagrant](https://www.vagrantup.com/downloads.html) and [virtualbox](https://www.virtualbox.org) installed on your local system). Wait few minutes until virtual box boots and than you can type in your browser `http://localhost:8080`.

Otherwise you should clone this repository and run `composer update` in checkouted www folder, change database configuration and execute these lines: <br />
`./bin/console doctrine:schema:update --force`<br />
`./bin/console translation:update lt --force`

# License

The MIT License (MIT)
Copyright (c) 2016 Raimondas Rimkevičius aka MekDrop <github@mekdrop.name>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
