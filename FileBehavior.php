<?php

namespace Creonit\PropelFileBehavior;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class FileBehavior extends Behavior
{
    public function modifyTable()
    {
        $table = $this->getTable();

        $table->addColumn([
            'name' => 'file_id',
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('file');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference('file_id', 'id');
        $table->addForeignKey($fk);

    }
}