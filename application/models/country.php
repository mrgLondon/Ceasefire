<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for Countries where incidents occured
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @subpackage Models
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
class Country_Model extends ORM {

    /**
     * Many-to-one relationship definition
     *
     * @var array
     */
    protected $belongs_to = array('location');

    /**
     * One-to-many relationship definition
     * @var array
     */
    protected $has_many = array('city');

    /**
     * Database table name
     *
     * @var string
     */
    protected $table_name = 'country';

    /**
     * Given a country name, returns a country model object reference. Country names
     * are unique so no two countries should have the same name
     *
     * @param string $country_name The name of the country
     * @return mixed ORM reference if country exists, FALSE otherwise
     */
    public static function get_country_by_name($country_name) {
        // Find the country with the specified name
        $country = self::factory('country')->where('country', $country_name)->find();

        // Return
        return ($country->loaded) ? $country : NULL;
    }

    /**
     * Given a country code, returns a country model object reference. Country codes are unique and ISO based
     *
     * @param string $country_code The two letter country code
     * @return mixed ORM reference if country exists, FALSE otherwise
     */
    public static function get_country_by_code($country_code) {
        // Find the country with the specified name
        $country = self::factory('country')->where('iso', $country_code)->find();

        // Return
        return ($country->loaded) ? $country : NULL;
    }

    /**
     * Returns a key=>value array of the list of countries in the database
     * ordered by the country name
     *
     * @return array
     */
    public static function get_countries_list() {
        $countries = array();
        foreach (ORM::factory('country')->orderby('country')->find_all() as $country) {
            // Check the length of the country name before adding it to the list
            $country_name = strlen($country->country) > 35 ? substr($country->country, 0, 35) . "..." : $country->country;

            $countries[$country->id] = $country_name;
        }

        return $countries;
    }

    /**
     * Gets all the $governorates for country
     */
    public function get_governorates($locale = '') {
        // Use default locale from settings if not specified
        if (!$locale) {
            $locale = Kohana::config('locale.language.0');
        }
        $governorates_base = ORM::factory('governorates')
                ->select('governorates.gov_id , governorates_lang.governorate AS governorate, lat, lon,governorates_lang.locale')
//                ->join('governorates_lang', 'INNER')
//                ->on('governorates_lang.gov_id','=','governorates.gov_id')
//                ->on('governorates_lang.country_id','=','governorates.country_id')
                ->join('governorates_lang', 'governorates_lang.gov_id', 'governorates.gov_id')
//                ->join('governorates_lang', 'governorates_lang.country_id', 'governorates.country_id')
                ->where('governorates.country_id', $this->id)
//                ->where('governorates.country_id', 'governorates_local.country_id')
                ->where('governorates_lang.locale', $locale)
                ->orderby('governorates.gov_id', 'asc')
                ->find_all();
        return $governorates_base;
    }

    /**
     * Gets all the cities for country
     */
    public function get_cities($locale = '') {
        // Use default locale from settings if not specified
        if (!$locale){
            $locale = Kohana::config('locale.language.0');
        }
        $ttt = ORM::factory('city')
                ->select('city.id as id, city_lang.city AS city, city_lat, city_lon,locale, city.gov_id as gov_id')
                ->join('city_lang', 'city_lang.id', 'city.id')
                ->where('country_id', $this->id)
                ->where('city_lang.locale', $locale)
                ->orderby('city', 'asc');
            $city_base = $ttt->find_all();
        return $city_base;


        /*
          if ($gov_id) {
          $city_base = ORM::factory('city')
          ->select('city.id as id, city_lang.city AS city, city_lat, city_lon,locale')
          ->join('city_lang', 'city_lang.id', 'city.id')
          ->where('country_id', $this->id)
          //->where('city.gov_id', 7)
          ->where('city.gov_id', $gov_id)
          ->where('city_lang.locale', $locale)
          ->orderby('city', 'asc')
          ->find_all();
          } else {
          $city_base = ORM::factory('city')
          ->select('city.id as id, city_lang.city AS city, city_lat, city_lon,locale')
          ->join('city_lang', 'city_lang.id', 'city.id')
          ->where('country_id', $this->id)
          ->where('city_lang.locale', $locale)
          ->orderby('city', 'asc')
          ->find_all();
          }
          return $city_base;
         * 
         */
    }

}
