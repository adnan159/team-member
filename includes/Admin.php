<?php

namespace Team\Member;

class Admin {

    public function __construct() {
        new Admin\Menu();
        new Admin\TeamMemberRegistration();
    }

}