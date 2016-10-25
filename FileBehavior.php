<?php

namespace Creonit\PropelFileBehavior;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class FileBehavior extends Behavior
{
    protected $parameters = [
        'parameter' => 'file_id',
    ];

    protected function addFileColumn($columnName){
        $table = $this->getTable();

        $table->addColumn([
            'name' => $columnName,
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('file');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference($columnName, 'id');
        $table->addForeignKey($fk);
    }

    public function modifyTable()
    {
        $columns = explode(',', $this->getParameter('parameter'));
        foreach ($columns as $column){
            $this->addFileColumn(trim($column));
        }
    }

    public function objectMethods($builder)
    {
        return $this->renderTemplate('objectMethods', ['table' => $this->getTable(), 'columns' => explode(',', $this->getParameter('parameter'))]);
    }
}