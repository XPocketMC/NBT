<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author xpocketmc Team
 * @link http://www.xpocketmc.net/
 *
 *
*/

declare(strict_types=1);

/**
 * Named Binary Tag handling classes
 */
namespace xpocketmc\nbt;

use xpocketmc\nbt\tag\ByteArrayTag;
use xpocketmc\nbt\tag\ByteTag;
use xpocketmc\nbt\tag\CompoundTag;
use xpocketmc\nbt\tag\DoubleTag;
use xpocketmc\nbt\tag\FloatTag;
use xpocketmc\nbt\tag\IntArrayTag;
use xpocketmc\nbt\tag\IntTag;
use xpocketmc\nbt\tag\ListTag;
use xpocketmc\nbt\tag\LongTag;
use xpocketmc\nbt\tag\ShortTag;
use xpocketmc\nbt\tag\StringTag;
use xpocketmc\nbt\tag\Tag;

abstract class NBT{

	public const TAG_End = 0;
	public const TAG_Byte = 1;
	public const TAG_Short = 2;
	public const TAG_Int = 3;
	public const TAG_Long = 4;
	public const TAG_Float = 5;
	public const TAG_Double = 6;
	public const TAG_ByteArray = 7;
	public const TAG_String = 8;
	public const TAG_List = 9;
	public const TAG_Compound = 10;
	public const TAG_IntArray = 11;

	/**
	 * @throws NbtDataException
	 */
	public static function createTag(int $type, NbtStreamReader $reader, ReaderTracker $tracker) : Tag{
		switch($type){
			case self::TAG_Byte:
				return ByteTag::read($reader);
			case self::TAG_Short:
				return ShortTag::read($reader);
			case self::TAG_Int:
				return IntTag::read($reader);
			case self::TAG_Long:
				return LongTag::read($reader);
			case self::TAG_Float:
				return FloatTag::read($reader);
			case self::TAG_Double:
				return DoubleTag::read($reader);
			case self::TAG_ByteArray:
				return ByteArrayTag::read($reader);
			case self::TAG_String:
				return StringTag::read($reader);
			case self::TAG_List:
				return ListTag::read($reader, $tracker);
			case self::TAG_Compound:
				return CompoundTag::read($reader, $tracker);
			case self::TAG_IntArray:
				return IntArrayTag::read($reader);
			default:
				throw new NbtDataException("Unknown NBT tag type $type");
		}
	}
}