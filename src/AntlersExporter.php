<?php

namespace Stillat\AntlersTranslationStringsExporter;

use KKomelin\TranslatableStringExporter\Core\Exporter;
use KKomelin\TranslatableStringExporter\Core\StringExtractor;
use KKomelin\TranslatableStringExporter\Core\Utils\IO;
use KKomelin\TranslatableStringExporter\Core\Utils\JSON;
use Stillat\AntlersTranslationStringsExporter\Extractor\TranslationStringExtractor;

class AntlersExporter extends Exporter
{
    /**
     * @var StringExtractor
     */
    private $bladeExtractor;

    /**
     * @var TranslationStringExtractor
     */
    private $antlersExtractor;

    public function __construct()
    {
        $this->bladeExtractor = new StringExtractor();
        $this->antlersExtractor = new TranslationStringExtractor();
    }

    public function export(string $language)
    {
        $bladeStrings = $this->bladeExtractor->extract();
        $antlersStrings = $this->antlersExtractor->extract();
        $new_strings = array_merge($bladeStrings, $antlersStrings);

        // Do all the things the package normally does.

        $language_path = IO::languageFilePath($language);

        // Read existing translation file for the chosen language.
        $existing_strings = IO::readTranslationFile($language_path);

        // Get the persistent strings.
        $persistent_strings_path =
            IO::languageFilePath(self::PERSISTENT_STRINGS_FILENAME_WO_EXT);
        $persistent_strings = IO::readTranslationFile($persistent_strings_path);

        // Add persistent strings to the export if enabled.
        $new_strings = $this->addPersistentStringsIfEnabled($new_strings, $persistent_strings);

        // Merge old an new translations preserving existing translations and persistent strings.
        $resulting_strings = $this->mergeStrings($new_strings, $existing_strings, $persistent_strings);

        // Exclude translation keys if enabled through the config.
        $resulting_strings = $this->excludeTranslationKeysIfEnabled($resulting_strings, $language);

        // Wisely sort the translations if enabled through the config.
        $sorted_strings = $this->advancedSortIfEnabled($resulting_strings);

        // Prepare JSON string and dump it to the translation file.
        $content = JSON::jsonEncode($sorted_strings);
        IO::write($content, $language_path);
    }
}
