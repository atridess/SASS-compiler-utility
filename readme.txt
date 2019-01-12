INSTALL INSTRUSCTION

to use utility you need Composer package manager (getcomposer.org)

after download progect(SASS-compiler-utility) download necessary packages by command:
$ composer update


HOW TO USE

$ bin/compile.php <arguments>

HOW TO USE: ARGUMENTS

compile.php input <filename> [ path <directory>(default ./) | output <filename>(default build.css) | format <formatname>(default nested) ]

  help, -h
    view help manual

  path, -p

    input path to SCSS folder (example 'path assets/stylesheets')

  input, -i
    input SCSS filemane (example 'input mixins.scss')

  output, -o
    output file (example 'output custom-build.css')

  format, -f expanded | nested(by default) | compressed | compact | crunched
    formating output CSS (example 'format compressed')
