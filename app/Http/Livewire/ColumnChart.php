<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expenditure;
use App\Models\Category;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class ColumnChart extends Component
{
    public $firstRun = true;
    public $showDataLabels = false;
    public $colors = [
        '1' => '#f6ad55',
        '2' => '#fc8181',
        '3' => '#90cdf4',
        '4' => '#66DA26',
        '5' => '#cbd5e0',
        '6' => '#5bdae0',
        '6' => '#5b62e0',
    ];

    public function render()
    {
        $categories = Category::all();        

        $expenses = Expenditure::with('category')->get();
        $columnChartModel = $expenses->groupBy('category_id')
            ->reduce(function ($columnChartModel, $data) {
                $typeID = $data->first()->category_id;
                $type = $data->first()->category->name;
                $value = $data->sum('amount');

                return $columnChartModel->addColumn($type, $value, $this->colors[$typeID]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Total amount by categories')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors(['#f6ad55', '#fc8181', '#90cdf4', '#66DA26', '#cbd5e0', '#5bdae0', '#5b62e0'])
                ->setColumnWidth(90)
                ->withGrid()
            );
        return view('livewire.column-chart')
            ->with([
                'columnChartModel' => $columnChartModel,
            ]);
    }
}
