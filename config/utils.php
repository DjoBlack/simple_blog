<?php

class Utils {

	const CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	public static function generateSalt() 
		{
			$randString = '';

			for ($i = 0; $i < rand(15, 65); $i++) 
			{
				$randString .= self::CHARS[rand(0, strlen(self::CHARS) - 1)];
			}

		return $randString;
			
		}
}