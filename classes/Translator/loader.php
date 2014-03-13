<?php

// Chargement des classes de la bibliothèque Translator
require_once(__DIR__ . '/Translator.class.php');
require_once(__DIR__ . '/TranslatorFormToJson.class.php');
require_once(__DIR__ . '/TranslatorJsonToHTML.class.php');
require_once(__DIR__ . '/TranslatorResultsetToStructure.class.php');
require_once(__DIR__ . '/TranslatorStructureToForm.class.php');

// Instanciation des singletons
$translatorFormToJson = new TranslatorFormToJson();
$translatorJsonToHTML = new TranslatorJsonToHTML();
$translatorResultsetToStructure = new TranslatorResulsetToStructure();
$translatorStructureToForm = new TranslatorStructureToForm();