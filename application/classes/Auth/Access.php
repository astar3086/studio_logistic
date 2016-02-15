<?php

namespace Auth;
use Utils\BitMask;

class Access extends BitMask
{
	const User_Login = 1;

    const User_Is_Admin     = 2;
    const User_Is_Moderator = 3;

	const PRIVACY_ADDRESS = 4;
    const User_holiday    = 5;
	const PRIVACY_PHONE   = 8;
	const PRIVACY_ALL     = 16;
}