# Maze generation

A simple collection of Maze generation algorithms I'm doing in my free time, so far in PHP only but that should change in the future. Each class is a single algorithm, and by default is output in the command line.

## How to

Just clone the repo, set inside each file the width and height of the maze you want to generate and call the file in your console.

```php
$maze = new Binary(6, 6);
$maze->generate()->printOut();
```

```
$ cd  mazes/PHP
$ php binary.php

+   +---+---+---+---+---+
|       |   |   |       |
+---+   +   +   +---+   +
|   |   |       |   |   |
+   +   +---+   +   +   +
|   |   |   |   |       |
+   +   +   +   +---+   +
|   |           |   |   |
+   +---+---+   +   +   +
    |   |   |   |       |
+   +   +   +   +---+   +
|                       |
+---+---+---+---+---+---+
```

## Contributing

If you like to contribute in any way (be it a comment or a pull request) feel free to do so.

## How to

Done so far:

* Binary
* Sidewinder
* Depth First Search

## License

This project is licensed under the MIT License

## Acknowledgments

* Mainly Jamis Buick with his Mazes for Programmers book