<?php
/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2009  HO Ngoc Phuong Trang <tranglich@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Tatoeba
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */
?>
<?php
$javascript->link('/js/vocabulary/of.ctrl.js', false);

$count = $paginator->counter('%count%');
$title = format(
    __("{username}'s vocabulary items ({number})", $count, true),
    array('username' => $username, 'number' => $count)
);

$this->set('title_for_layout', $pages->formatTitle($title));
?>

<div id="annexe_content">
    <?php echo $this->element('vocabulary/menu'); ?>

    <?php $commonModules->createFilterByLangMod(2); ?>
</div>

<div id="main_content" ng-controller="VocabularyOfController as ctrl">
    <div class="section" md-whiteframe="1">
        <h2><?= $title ?></h2>

        <?php
        $paginationUrl = array($username);
        $pagination->display($paginationUrl);
        ?>

        <md-list flex>
            <?php
            foreach($vocabulary as $item) {
                $id = $item['Vocabulary']['id'];
                $divId = bin2hex($id);
                $lang = $item['Vocabulary']['lang'];
                $text = $item['Vocabulary']['text'];
                $numSentences = $item['Vocabulary']['numSentences'];
                $numSentencesLabel = $numSentences == 1000 ? '1000+' : $numSentences;
                $url = $html->url(array(
                    'controller' => 'sentences',
                    'action' => 'search',
                    '?' => array(
                        'query' => '="' . $text . '"',
                        'from' => $lang
                    )
                ));
                ?>
                <md-list-item id="vocabulary_<?= $divId ?>">
                    <img class="vocabulary-lang" src="/img/flags/<?= $lang ?>.png"/>
                    <div class="vocabulary-text" flex><?= $text ?></div>
                    <md-button class="md-primary" href="<?= $url ?>">
                        <?= format(
                            __n(
                                '{number} sentence', '{number} sentences',
                                $numSentences,
                                true
                            ),
                            array('number' => $numSentencesLabel)
                        ); ?>
                    </md-button>
                    <? if ($canEdit) { ?>
                        <md-button ng-click="ctrl.remove('<?= $divId ?>')"
                                   class="md-icon-button">
                            <md-icon aria-label="Remove">delete</md-icon>
                        </md-button>
                    <? } ?>
                </md-list-item>
                <?php
            }
            ?>
        </md-list>

        <?php
        $paginationUrl = array($username);
        $pagination->display($paginationUrl);
        ?>
    </div>

</div>
