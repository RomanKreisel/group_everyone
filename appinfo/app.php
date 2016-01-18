<?php

namespace OCA\group_everyone;

class GROUP_EVERY implements \OCP\GroupInterface {
    const GroupName = "Everyone";

    public function implementsActions($actions) { return false; }
    public function inGroup($uid, $gid) { return ($gid === self::GroupName); }
    public function getUserGroups($uid) { return array(self::GroupName); }
    public function groupExists($gid) { return ($gid === self::GroupName); }

    public function getGroups($search = '', $limit = -1, $offset = 0) {
           if ($offset <= 0 && (!strlen($search) || false !== stripos(self::GroupName, $search))) return array(self::GroupName);
           return array();
    }

    public function usersInGroup($gid, $search = '', $limit = -1, $offset = 0) {
           if ($gid !== self::GroupName) return array();
           return \OC_User::getUsers($search, $limit, $offset);
    }
}

\OC_Group::useBackend(new GROUP_EVERY());
