<?php


namespace App\Enums;

enum PetBreeds: string
{

    // ========================================
    // CHIENS - PAR ORDRE ALPHABÉTIQUE
    // ========================================

    case AFGHAN_HOUND = 'afghan_hound';
    case AIREDALE_TERRIER = 'airedale_terrier';
    case AKITA_INU = 'akita_inu';
    case ALASKAN_MALAMUTE = 'alaskan_malamute';
    case AMERICAN_BULLDOG = 'american_bulldog';
    case AMERICAN_STAFFORDSHIRE_TERRIER = 'american_staffordshire_terrier';
    case AUSTRALIAN_SHEPHERD = 'australian_shepherd';
    case BASENJI = 'basenji';
    case BASSET_HOUND = 'basset_hound';
    case BEAGLE = 'beagle';
    case BEARDED_COLLIE = 'bearded_collie';
    case BELGIAN_SHEPHERD = 'belgian_shepherd';
    case BICHON_FRISE = 'bichon_frise';
    case BLOODHOUND = 'bloodhound';
    case BORDER_COLLIE = 'border_collie';
    case BOSTON_TERRIER = 'boston_terrier';
    case BOXER = 'boxer';
    case BRITTANY = 'brittany';
    case BULL_TERRIER = 'bull_terrier';
    case BULLMASTIFF = 'bullmastiff';
    case CAIRN_TERRIER = 'cairn_terrier';
    case CANE_CORSO = 'cane_corso';
    case CAVALIER_KING_CHARLES = 'cavalier_king_charles';
    case CHESAPEAKE_BAY_RETRIEVER = 'chesapeake_bay_retriever';
    case CHIHUAHUA = 'chihuahua';
    case CHOW_CHOW = 'chow_chow';
    case COCKER_SPANIEL = 'cocker_spaniel';
    case COLLIE = 'collie';
    case COTON_DE_TULEAR = 'coton_de_tulear';
    case DACHSHUND = 'dachshund';
    case DALMATIAN = 'dalmatian';
    case DOBERMAN = 'doberman';
    case DOGUE_DE_BORDEAUX = 'dogue_de_bordeaux';
    case ENGLISH_BULLDOG = 'english_bulldog';
    case ENGLISH_SETTER = 'english_setter';
    case ENGLISH_SPRINGER_SPANIEL = 'english_springer_spaniel';
    case FINNISH_SPITZ = 'finnish_spitz';
    case FLAT_COATED_RETRIEVER = 'flat_coated_retriever';
    case FOX_TERRIER = 'fox_terrier';
    case FRENCH_BULLDOG = 'french_bulldog';
    case GERMAN_SHEPHERD = 'german_shepherd';
    case GOLDEN_RETRIEVER = 'golden_retriever';
    case GREAT_DANE = 'great_dane';
    case GREYHOUND = 'greyhound';
    case HARRIER = 'harrier';
    case HAVANESE = 'havanese';
    case IRISH_SETTER = 'irish_setter';
    case ITALIAN_GREYHOUND = 'italian_greyhound';
    case JACK_RUSSELL_TERRIER = 'jack_russell_terrier';
    case KEESHOND = 'keeshond';
    case LABRADOR_RETRIEVER = 'labrador_retriever';
    case LEONBERGER = 'leonberger';
    case LHASA_APSO = 'lhasa_apso';
    case MALTESE = 'maltese';
    case MASTIFF = 'mastiff';
    case MINIATURE_DACHSHUND = 'miniature_dachshund';
    case MINIATURE_POODLE = 'miniature_poodle';
    case NEWFOUNDLAND = 'newfoundland';
    case OLD_ENGLISH_SHEEPDOG = 'old_english_sheepdog';
    case PAPILLON = 'papillon';
    case PEKINGESE = 'pekingese';
    case POINTER = 'pointer';
    case POMERANIAN = 'pomeranian';
    case POODLE = 'poodle';
    case PRESA_CANARIO = 'presa_canario';
    case PUG = 'pug';
    case RHODESIAN_RIDGEBACK = 'rhodesian_ridgeback';
    case ROTTWEILER = 'rottweiler';
    case SAINT_BERNARD = 'saint_bernard';
    case SALUKI = 'saluki';
    case SAMOYED = 'samoyed';
    case SCOTTISH_TERRIER = 'scottish_terrier';
    case SHAR_PEI = 'shar_pei';
    case SHETLAND_SHEEPDOG = 'shetland_sheepdog';
    case SHIBA_INU = 'shiba_inu';
    case SHIH_TZU = 'shih_tzu';
    case SIBERIAN_HUSKY = 'siberian_husky';
    case STAFFORDSHIRE_BULL_TERRIER = 'staffordshire_bull_terrier';
    case TIBETAN_TERRIER = 'tibetan_terrier';
    case TOY_POODLE = 'toy_poodle';
    case VIZSLA = 'vizsla';
    case WEIMARANER = 'weimaraner';
    case WEST_HIGHLAND_WHITE_TERRIER = 'west_highland_white_terrier';
    case WHIPPET = 'whippet';
    case YORKSHIRE_TERRIER = 'yorkshire_terrier';

    // ========================================
    // CHATS - PAR ORDRE ALPHABÉTIQUE
    // ========================================

    case ABYSSINIAN = 'abyssinian';
    case AMERICAN_BOBTAIL = 'american_bobtail';
    case AMERICAN_CURL = 'american_curl';
    case AMERICAN_SHORTHAIR = 'american_shorthair';
    case BALINESE = 'balinese';
    case BENGAL = 'bengal';
    case BIRMAN = 'birman';
    case BOMBAY = 'bombay';
    case BRITISH_SHORTHAIR = 'british_shorthair';
    case BURMESE = 'burmese';
    case CHARTREUX = 'chartreux';
    case CHAUSIE = 'chausie';
    case CORNISH_REX = 'cornish_rex';
    case DEVON_REX = 'devon_rex';
    case EGYPTIAN_MAU = 'egyptian_mau';
    case EUROPEAN_SHORTHAIR = 'european_shorthair';
    case EXOTIC_SHORTHAIR = 'exotic_shorthair';
    case HAVANA_BROWN = 'havana_brown';
    case HIGHLAND_FOLD = 'highland_fold';
    case HIMALAYAN = 'himalayan';
    case JAPANESE_BOBTAIL = 'japanese_bobtail';
    case KORAT = 'korat';
    case LAPERM = 'laperm';
    case LYKOI = 'lykoi';
    case MAINE_COON = 'maine_coon';
    case MANX = 'manx';
    case MUNCHKIN = 'munchkin';
    case NEBELUNG = 'nebelung';
    case NORWEGIAN_FOREST = 'norwegian_forest';
    case OCICAT = 'ocicat';
    case ORIENTAL_LONGHAIR = 'oriental_longhair';
    case ORIENTAL_SHORTHAIR = 'oriental_shorthair';
    case PERSIAN = 'persian';
    case PIXIE_BOB = 'pixie_bob';
    case RAGAMUFFIN = 'ragamuffin';
    case RAGDOLL = 'ragdoll';
    case RUSSIAN_BLUE = 'russian_blue';
    case SAVANNAH = 'savannah';
    case SCOTTISH_FOLD = 'scottish_fold';
    case SELKIRK_REX = 'selkirk_rex';
    case SIAMESE = 'siamese';
    case SIBERIAN = 'siberian';
    case SINGAPURA = 'singapura';
    case SOMALI = 'somali';
    case SPHYNX = 'sphynx';
    case TONKINESE = 'tonkinese';
    case TOYGER = 'toyger';
    case TURKISH_ANGORA = 'turkish_angora';
    case TURKISH_VAN = 'turkish_van';

    // ========================================
    // RACES MIXTES / INCONNUES
    // ========================================
    case MIXED_BREED = 'mixed_breed';
    case UNKNOWN = 'unknown';

}
