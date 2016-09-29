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
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>


class StartGamePacket extends DataPacket{
	const NETWORK_ID = Info::START_GAME_PACKET;

	public $entityUniqueId;
	public $entityRuntimeId;
	public $x;
	public $y;
	public $z;
	public $seed;
	public $dimension;
	public $generator = 1; //default infinite
	public $worldGamemode;
	public $difficulty;
	public $spawnX;
	public $spawnY;
	public $spawnZ;
	public $hasBeenLoadedInCreative = 1;
	public $dayCycleStopTime = -1; //-1 = not stopped, any positive value = stopped at that time
	public $eduMode = 0;
	public $rainLevel = 0;
	public $lightningLevel = 0;
	public $commandsEnabled = 0; //disabled for now to prevent crash
	public $unknown; //still no idea what this is for
	public $worldName;

	public function decode(){

	}

	public function encode(){
		$this->reset();
		$this->putEntityId($this->entityUniqueId); //EntityUniqueID
		$this->putEntityId($this->entityRuntimeId); //EntityRuntimeID (basically just the normal entityID)
		$this->putVector3f($this->x, $this->y, $this->z);
		$this->putLFloat(0); //TODO: find out what these are (yaw/pitch?)
		$this->putLFloat(0);
		$this->putVarInt($this->seed); //seed (varint)
		$this->putVarInt($this->dimension); //dimension (varint)
		$this->putVarInt($this->generator); //generator (varint)
		$this->putVarInt($this->worldGamemode);
		$this->putVarInt($this->difficulty); //Difficulty (TODO)
		$this->putBlockCoords($this->spawnX, $this->spawnY, $this->spawnZ);
		$this->putByte($this->hasBeenLoadedInCreative); //has been loaded in creative (no Xbox achievements (well, this is impossible anyway))
		$this->putVarInt($this->dayCycleStopTime); //dayCycleStopTime - NOTE: This is the TIME that the world is stopped at. If this is set to a positive number, client will not update world time automatically.
		$this->putByte($this->eduMode); //edu mode
		$this->putLFloat($this->rainLevel); //rain level
		$this->putLFloat($this->lightningLevel); //lightning level
		$this->putByte($this->commandsEnabled); //commands enabled
		$this->putString($this->unknown);
		$this->putString($this->worldName);
	}

}
