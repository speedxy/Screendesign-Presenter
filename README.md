#screens: Screendesign Presenter

With this tool, you can easily present your screen designs. You can present either complete designs or desings who are split into separate images. Just create a project folder in /screens and add your designs. Now you can access your project for presentation via /project-name.

## Requirements

Needs PHP yaml-extension:

```
extension=yaml.so
```

## Usage
Add folders so /screens like `/screens/project_name` and add your screen design in formats `.jpg`/`.jpeg`/`.png`. If you want to secure your links, you could use some random characters in your project name, e.g. `/screens/project_name-js29d`.
If you want to use subfolders, just create some. There are tow special subfolders:
* mobile: If accessed, the view is rendered for mobile devices.
* tablet: If accessed, the view is rendered for tablets.

### Keyboard control
Key     | Action
:------:|-------
&larr;  | Go one slide back
&rarr;  | Go one slide forward
&uarr;  | Go to the first slide
&darr;  | Go to the last slide
esc     | Show/hide this message
space   | Next Step (Hide this message or go to the next slide. If you are on the last slide, it returns to the first slide.)
n       | Show/hide the navigation
0 - 9   | Go to the corresponding slide. 0 is slide number 10.

### Configuration
There can be a file called `config.yaml`in each project directory to configure your project.

Following options are available:

```
style:
	bg: Background-color as string of hex, e.g. "red" or "#E0E0E0"
```


## ToDo
* Tablet compatibility and support of touch-screens (e.g. navigation with slide/swipe gestures)
* Make script independent of yaml.so
