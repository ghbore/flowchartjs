# [Flowchart Plugin]((http://dokuwiki.org/plugin:flowchartjs)) for Dokuwiki

[![2023-04-04a](https://github.com/ghbore/flowchartjs/actions/workflows/test-2023-04-04.yml/badge.svg)](https://github.com/ghbore/flowchartjs/actions/workflows/test-2023-04-04.yml)
[![2022-07-31a](https://github.com/ghbore/flowchartjs/actions/workflows/test-2022-07-31.yml/badge.svg)](https://github.com/ghbore/flowchartjs/actions/workflows/test-2022-07-31.yml)

**Draw flowchart (SVG) based on [flowchart.js](flowchart.js.org)**

## Example
The example copied from [flowchart.js](flowchart.js.org):

```
<flowchartjs default>
  st=>start: Start|past:>http://www.google.com[blank]
  e=>end: End|future:>http://www.google.com
  op1=>operation: My Operation|past
  op2=>operation: Stuff|current
  sub1=>subroutine: My Subroutine|invalid
  cond=>condition: Yes
  or No?|approved:>http://www.google.com
  c2=>condition: Good idea|rejected
  io=>inputoutput: catch something...|future
  st->op1(right)->cond
  cond(yes, right)->c2
  cond(no)->sub1(left)->op1
  c2(yes)->io->e
  c2(no)->op2->e
</flowchartjs>
```

The output looks like:
![](https://www.dokuwiki.org/lib/exe/fetch.php?tok=02f4a0&media=https%3A%2F%2Fimg-fotki.yandex.ru%2Fget%2F108168%2F85226599.d%2F0_c9c93_de8fec8e_orig.png)

## Syntax
The Basic syntax is:
```
<flowchartjs style width height>...</flowchart>
```
where,
- *style*: This parameter refers to the chosen display style for the flowchart. At present, it offers the following options:
    - (blank) — no style
    - *default* — the default style
    - Alternatively, you can select from other available styles (see below about how to manage the styles)
- *width* and *height*: These parameters accept CSS-style values that allow for the adjustment of the width and height of the associated SVG element. Leaving these fields blank will maintain the default measurements.
- *...*: This section encompasses the flowchart definition itself, which should adhere to the grammar outlined in [flowchart.js](flowchart.js.org)

## Configuration and Settings
Using the **Amin Plugin**, managers can upload new flowchart styles, or update existing ones through JSON files. These files must have the *.json* extension, and the filename serving as the designated style name. Manager also can remove any styles as needed.

Within the textbox, toolbar **FC** icon will insert a pair of *flowchartjs* tags, and **F<sub>c</sub><sup>s</sup>** toggles the comprehensive list of available styles.