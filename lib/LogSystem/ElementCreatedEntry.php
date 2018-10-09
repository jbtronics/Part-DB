<?php
/**
 * Created by PhpStorm.
 * User: janhb
 * Date: 06.02.2018
 * Time: 18:52
 */

namespace PartDB\LogSystem;

use Exception;
use PartDB\Base\DBElement;
use PartDB\Base\NamedDBElement;
use PartDB\Database;
use PartDB\Log;
use PartDB\Part;
use PartDB\User;

class ElementCreatedEntry extends BaseEntry
{

    /**
     * @var $element NamedDBElement
     */
    protected $element;

    protected $creation_instock = null;

    /**
     * Constructor
     *
     * @note  It's allowed to create an object with the ID 0 (for the root element).
     *
     * @param Database  &$database      reference to the Database-object
     * @param User      &$current_user  reference to the current user which is logged in
     * @param Log       &$log           reference to the Log-object
     * @param integer   $id             ID of the filetype we want to get
     *
     * @throws Exception    if there is no such attachement type in the database
     * @throws Exception    if there was an error
     */
    public function __construct(&$database, &$current_user, &$log, $id, $db_data = null)
    {
        parent::__construct($database, $current_user, $log, $id, $db_data);

        //Check if we have selcted the right type
        if ($this->getTypeID() != Log::TYPE_ELEMENTCREATED) {
            throw new \RuntimeException(_("Falscher Logtyp!"));
        }

        try {
            $class = Log::targetTypeIDToClass($this->getTargetType());
            $this->element = new $class($database, $current_user, $log, $this->getTargetID());
        } catch (Exception $ex) {

        }

        $arr = $this->deserializeExtra();
        if (isset($arr['i'])) {
            $this->creation_instock = $arr['i'];
        }
    }

    /**
     * Checks if this Entry has an instock at creation value.
     * @return bool true if this entry has this value.
     */
    public function hasCreationInstockValue()
    {
        return $this->creation_instock != null;
    }

    /**
     * Returns the instock the part created via this entry has, when it was created.
     * @return int|null Null, if no instock value is existing, otherwise the value.
     */
    public function getCreationInstockValue()
    {
        return $this->creation_instock;
    }

    /**
     * Adds a new log entry to the database.
     * @param $database Database The database which should be used for requests.
     * @param $current_user User The database which should be used for requests.
     * @param $log Log The database which should be used for requests.
     * @param $element NamedDBElement The ip adress the user loggs in from
     *
     * @return static|BaseEntry The new created Entry.
     *
     * @throws Exception
     */
    public static function add(&$database, &$current_user, &$log, &$element)
    {
        $type_id = Log::elementToTargetTypeID($element);

        if ($type_id == Log::TARGET_TYPE_USER || $type_id == Log::TARGET_TYPE_GROUP) {
            //When a user or group is edited, this needs more attention, so higher level.
            $level = Log::LEVEL_NOTICE;
        } else {
            $level = Log::LEVEL_INFO;
        }

        $arr = array();
        if($element instanceof Part) {
            /** @var Part */
            $arr['i'] = $element->getInstock();
        }

        return static::addEntry(
            $database,
            $current_user,
            $log,
            Log::TYPE_ELEMENTCREATED,
            $level,
            $current_user->getID(),
            $type_id,
            $element->getID(),
            $arr
        );
    }

    /**
     * Returns the a text representation of the target
     * @return string The text describing the target
     */
    public function getTargetText()
    {
        try {
            $part_name = ($this->element != null) ? $this->element->getName() : $this->getTargetID();
            return Log::targetTypeIDToString($this->getTargetType()) . ": " . $part_name;
        } catch (Exception $ex) {
            return "ERROR!";
        }
    }

    /**
     * Return a link to the target. Returns empty string if no link is available.
     * @return string the link to the target.
     */
    public function getTargetLink()
    {
        //We can not link to a part, that dont exists any more...
        return Log::generateLinkForTarget($this->getTargetType(), $this->getTargetID());
    }

    /**
     * Returns some extra information which is shown in the extra coloumn, of the log
     * @param $html bool Set this to true, to get an HTML formatted version of the extra.
     * @return string The extra information
     */
    public function getExtra($html = false)
    {
        if($this->hasCreationInstockValue()) {
            return _("Anzahl: ") . $this->getCreationInstockValue();
        }

            return "";
    }
}