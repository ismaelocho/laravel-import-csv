<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expenditure;
use App\Models\Category;

class Expenditures extends Component
{

    public $categories, $expenses, $user_id, $category_id, $expense, $amount, $date, $expense_id;
    public $isOpen = 0;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->expenses = Expenditure::with('category')->get();
        $this->categories = Category::all();
        return view('livewire.expenditures');
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){  
        $this->expense = '';
        $this->amount = '';
        $this->date = '';
        $this->expense_id = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'expense' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
   
        Expenditure::updateOrCreate(['id' => $this->expense_id], [
            'user_id' => $this->user_id,
            'expense' => $this->expense,
            'amount' => $this->amount,
            'date' => $this->date,
            'category_id' => $this->category_id
        ]);
  
        session()->flash('message', 
            $this->expense_id ? 'Post Updated Successfully. ID:'.$this->expense_id : 'Post Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $expense = Expenditure::findOrFail($id);
        $this->expense_id = $id;
        $this->user_id = $expense->user_id;
        $this->expense = $expense->expense;
        $this->amount = $expense->amount;
        $this->date = $expense->date;
        $this->category_id = $expense->category_id;
    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Expenditure::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
