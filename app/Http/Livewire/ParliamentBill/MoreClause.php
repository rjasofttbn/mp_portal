<?php

namespace App\Http\Livewire\ParliamentBill;

use Livewire\Component;

class MoreClause extends Component
{
    public $editData, $coma;
    public $inputs = [];
    public $i = 0;
    public $deletedRows;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function add($i)
    {
        array_push($this->inputs, [
            'title' => '',
            'number' => '',
            'status' => '',
            'sub_clause_qty' => '',
        ]);
    }

    public function testMe($i){
        return 'Hello I am row number: '.$i;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i, $deletedId = null)
    {
        unset($this->inputs[$i]);
        // if ($i != 1) {
        //     $this->coma = ',';
        // }
        $this->deletedRows .= $deletedId.',';
    }

    public function render()
    {
        return view('livewire.parliament-bill.more-clause');
    }

    public function mount()
    {
        if ($this->editData) {
            foreach ($this->editData['clauses'] as $key => $value) {
                array_push($this->inputs, [
                    'clause_id' => $value->id,
                    'title' => $value->title,
                    'number' => $value->number,
                    'status' => $value->status,
                    'sub_clause_qty' => count($value['subClauses']),
                ]);
            }
        }else{
            array_push($this->inputs, [
                [
                    'title' => '',
                    'number' => '',
                    'status' => '',
                    'sub_clause_qty' => ''
                ]
            ]);
        }
    }

}
