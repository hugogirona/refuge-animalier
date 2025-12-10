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

    /**
     * Retourne la liste de tous les chiens.
     * @return array<self>
     */
    public static function dogs(): array
    {
        return [
            self::AFGHAN_HOUND,
            self::AIREDALE_TERRIER,
            self::AKITA_INU,
            self::ALASKAN_MALAMUTE,
            self::AMERICAN_BULLDOG,
            self::AMERICAN_STAFFORDSHIRE_TERRIER,
            self::AUSTRALIAN_SHEPHERD,
            self::BASENJI,
            self::BASSET_HOUND,
            self::BEAGLE,
            self::BEARDED_COLLIE,
            self::BELGIAN_SHEPHERD,
            self::BICHON_FRISE,
            self::BLOODHOUND,
            self::BORDER_COLLIE,
            self::BOSTON_TERRIER,
            self::BOXER,
            self::BRITTANY,
            self::BULL_TERRIER,
            self::BULLMASTIFF,
            self::CAIRN_TERRIER,
            self::CANE_CORSO,
            self::CAVALIER_KING_CHARLES,
            self::CHESAPEAKE_BAY_RETRIEVER,
            self::CHIHUAHUA,
            self::CHOW_CHOW,
            self::COCKER_SPANIEL,
            self::COLLIE,
            self::COTON_DE_TULEAR,
            self::DACHSHUND,
            self::DALMATIAN,
            self::DOBERMAN,
            self::DOGUE_DE_BORDEAUX,
            self::ENGLISH_BULLDOG,
            self::ENGLISH_SETTER,
            self::ENGLISH_SPRINGER_SPANIEL,
            self::FINNISH_SPITZ,
            self::FLAT_COATED_RETRIEVER,
            self::FOX_TERRIER,
            self::FRENCH_BULLDOG,
            self::GERMAN_SHEPHERD,
            self::GOLDEN_RETRIEVER,
            self::GREAT_DANE,
            self::GREYHOUND,
            self::HARRIER,
            self::HAVANESE,
            self::IRISH_SETTER,
            self::ITALIAN_GREYHOUND,
            self::JACK_RUSSELL_TERRIER,
            self::KEESHOND,
            self::LABRADOR_RETRIEVER,
            self::LEONBERGER,
            self::LHASA_APSO,
            self::MALTESE,
            self::MASTIFF,
            self::MINIATURE_DACHSHUND,
            self::MINIATURE_POODLE,
            self::NEWFOUNDLAND,
            self::OLD_ENGLISH_SHEEPDOG,
            self::PAPILLON,
            self::PEKINGESE,
            self::POINTER,
            self::POMERANIAN,
            self::POODLE,
            self::PRESA_CANARIO,
            self::PUG,
            self::RHODESIAN_RIDGEBACK,
            self::ROTTWEILER,
            self::SAINT_BERNARD,
            self::SALUKI,
            self::SAMOYED,
            self::SCOTTISH_TERRIER,
            self::SHAR_PEI,
            self::SHETLAND_SHEEPDOG,
            self::SHIBA_INU,
            self::SHIH_TZU,
            self::SIBERIAN_HUSKY,
            self::STAFFORDSHIRE_BULL_TERRIER,
            self::TIBETAN_TERRIER,
            self::TOY_POODLE,
            self::VIZSLA,
            self::WEIMARANER,
            self::WEST_HIGHLAND_WHITE_TERRIER,
            self::WHIPPET,
            self::YORKSHIRE_TERRIER,
            self::MIXED_BREED,
        ];
    }

    /**
     * Retourne la liste de tous les chats.
     * @return array<self>
     */
    public static function cats(): array
    {
        return [
            self::ABYSSINIAN,
            self::AMERICAN_BOBTAIL,
            self::AMERICAN_CURL,
            self::AMERICAN_SHORTHAIR,
            self::BALINESE,
            self::BENGAL,
            self::BIRMAN,
            self::BOMBAY,
            self::BRITISH_SHORTHAIR,
            self::BURMESE,
            self::CHARTREUX,
            self::CHAUSIE,
            self::CORNISH_REX,
            self::DEVON_REX,
            self::EGYPTIAN_MAU,
            self::EUROPEAN_SHORTHAIR,
            self::EXOTIC_SHORTHAIR,
            self::HAVANA_BROWN,
            self::HIGHLAND_FOLD,
            self::HIMALAYAN,
            self::JAPANESE_BOBTAIL,
            self::KORAT,
            self::LAPERM,
            self::LYKOI,
            self::MAINE_COON,
            self::MANX,
            self::MUNCHKIN,
            self::NEBELUNG,
            self::NORWEGIAN_FOREST,
            self::OCICAT,
            self::ORIENTAL_LONGHAIR,
            self::ORIENTAL_SHORTHAIR,
            self::PERSIAN,
            self::PIXIE_BOB,
            self::RAGAMUFFIN,
            self::RAGDOLL,
            self::RUSSIAN_BLUE,
            self::SAVANNAH,
            self::SCOTTISH_FOLD,
            self::SELKIRK_REX,
            self::SIAMESE,
            self::SIBERIAN,
            self::SINGAPURA,
            self::SOMALI,
            self::SPHYNX,
            self::TONKINESE,
            self::TOYGER,
            self::TURKISH_ANGORA,
            self::TURKISH_VAN,
            self::MIXED_BREED,
        ];
    }

    public static function random(?array $subset = null): self
    {
        $pool = $subset ?? self::cases();

        return $pool[array_rand($pool)];
    }

}
