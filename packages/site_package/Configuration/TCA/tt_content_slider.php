<?php

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
/**
 * site_package Content Element | sitepackage_slider
 */

/***************
 * Register fields
 */
$sitepackage_slider_fields = [
    'gradient' => [
        'exclude' => 1,
        'label' => 'Verlauf',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                ['Dunkler Verlauf von unten nach oben', '']
            ]
        ]
    ],
];

ExtensionManagementUtility::addTCAcolumns('tt_content', $sitepackage_slider_fields);

/***************
 * Add Content Element: sitepackage_slider
 */
$GLOBALS['TCA']['tt_content']['types']['sitepackage_slider'] = [
    'columnsOverrides' => [
        'image' => [
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('image', [
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true
                ],
                'minitems' => 1,
                'maxitems' => 99,
                'overrideChildTca' => [
                    'types' => [
                        File::FILETYPE_IMAGE => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                    ],
                ],
            ], 'JPG,JPEG,PNG')
        ],
    ],
];


/***************
 * Add content element to selector list
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'Slider',
        'sitepackage_slider',
        'content-image'
    ],
    '--div--',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['sitepackage_slider'] = 'content-image';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['sitepackage_slider']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['header']['showitem'];

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'image,gradient',
    'sitepackage_slider',
    'after:header'
);
