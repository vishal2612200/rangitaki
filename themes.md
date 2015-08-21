# Theme Documentation

##### For Rangitaki version 1.0.0

In this directory I will explain what each property of a design css file describes. To create a new theme, just copy one of the available and change it to your liking.

## Content

 1. Header
 
 2. Navigation Drawer
 
 3. Body
 
 4. Footer and FAB
 
## 1 Header

`div .header`

The header bar (aka actionbar) on the top of the page.

`span .title`

The element which contains the title of the blog / subblog. It is in the header.

`a .title > a`

The link in side to *.title* used to reload the page.

`div .fadeout`

This is a fadeout which is normally not visible. It fades the text out, if the *.title* is longer than the *.header*

## 2 Navigation Drawer

`div .nav`

The navigation drawer. It contains the page navigation.

`div .nav-item`

A item in the navigation drawer, which is clickable.

`div .nav-item-static`

The same as a *.nav-item*, but not clickable.

`div .divider`

A divider between different section in the navigation drawer.

## 3 Body

`div .card`

A box which surrounds a whole blog posts (or blog intro)

`a .card > a`

A link in a post / intro.

`a .headline`

The headline / title of a post.

`div .date`

The datestamp of a post.

`div .articletext`

The text of a blog post / blog intro.

`span .author`

The author of a blog post.

`a .tag`

A tag of a blog post. If there are multiple tags, every tag has the class *.tag*.

## 4 Footer and FAB

`div .fabmenu`

The menu which contains the FAB buttons.

`div .fab`

The FAB button, always visible.

`div .subfab`

A subfab, shown if the *.fab* is clicked.

`div .footer`

The footer at the end of a page.

`a .footer > a`

A link in the footer.
