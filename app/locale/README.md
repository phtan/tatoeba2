UI Translations
===============

How to add a new UI language
----------------------------

#### Step 1

Create in here (`app/locale/`) the folder for the language. 
The name of folder should be the ISO 639-3 language code.
There may be exceptions.

> For instance if you were adding Italian as a new UI language,
you would create a folder named `ita`.


#### Step 2

Inside of the language folder, create another folder named 
`LC_MESSAGES`. And create an empty file with the same name as 
the .po file on Transifex.

> For instance, for Italian, you would create an empty file named
`it.po`.

If you do not create a file, you will not be able to commit the
new folders that you created. 
In fact it doesn't really matter how the file is called, but it's 
better to name it with the same name as the .po file on Transifex 
so that it gets overriden with the actual Transifex file.

#### Step 3

Update the script `docs/update-translations.py`.
In the `languagesTable`, you need to add the array for the
new language. Otheriwse the translation for that language will
not be downloaded from Transifex. The array has 2 values:
the language code used by Transifex (usually 2 letters), and 
the language code used by Tatoeba (usually 3 letters).

> For instance for Italian, you would add `['it', 'ita']`.


#### Step 4

Update the `.tx/config`. In the `lang_map`, you need to
add again the Transifex code and the Tatoeba code. This
allows to use the transifex command line tool `tx`.

> For instance for Italian, you would add `it:ita`.


#### Step 5

Make the language available in the drop-down box
by adding it to the `UI.languages` list in the file
`app/config/core.php.template`. Read the comments in
that file for more information.

> For instance for Italian, you would add `array('ita', 'it', 'Italiano'),`

#### Step 6

Make the language available on http://dev.tatoeba.org/
by asking an administrator (or do it yourself if you’re an administrator)
so that the result of the translation is directly viewable by translators.

* commit the above changes
* run `git pull` on the repository of http://dev.tatoeba.org/
* add the language in the `core.php` file of http://dev.tatoeba.org/

