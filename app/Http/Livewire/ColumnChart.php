<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expenditure;
use App\Models\Category;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Illuminate\Support\Facades\Auth;

class ColumnChart extends Component
{
    public $firstRun = true;
    public $showDataLabels = true;
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
        $userID = Auth::id();
        $expenses = Expenditure::with('category')->where('user_id',  $userID)->get();
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
        
        $expenses = Expenditure::with('category')->where('user_id',  $userID)->get();
        $pieChartModel = $expenses->groupBy('category_id')
            ->reduce(function ($pieChartModel, $data) {
                $typeID = $data->first()->category_id;
                $type = $data->first()->category->name;
                $value = $data->sum('amount');

                return $pieChartModel->addSlice($type, $value, $this->colors[$typeID]);
            }, LivewireCharts::pieChartModel()
                //->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->setType('donut')
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#f6ad55', '#fc8181', '#90cdf4', '#66DA26', '#cbd5e0', '#5bdae0', '#5b62e0'])
            );
        
        $expenses = Expenditure::with('category')->where('user_id',  $userID)->get();
        $lineChartModel = $expenses->groupBy('category_id')
            ->reduce(function ($lineChartModel, $data) {
                $typeID = $data->first()->category_id;
                $index = $data->first()->category->name;

                $amountTotal = $data->count('amount');

                if ($index == 6) {
                    $lineChartModel->addMarker(7, $amountTotal);
                }

                if ($index == 11) {
                    $lineChartModel->addMarker(12, $amountTotal);
                }

                return $lineChartModel->addPoint($index, $amountTotal, $this->colors[$typeID]);
            }, LivewireCharts::lineChartModel()
                ->setTitle('Total items by categories')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            );
        
        $treeChartModel = $expenses->groupBy('category_id')
            ->reduce(function (TreeMapChartModel $chartModel, $data) {
                $typeID = $data->first()->category_id;
                $type = $data->first()->category->name;
                $value = $data->count('amount');

                return $chartModel->addBlock($type, $value)->addColor($this->colors[$typeID]);
            }, LivewireCharts::treeMapChartModel()
                ->setTitle('Total items by categories')
                ->setAnimated($this->firstRun)
                ->setDistributed(true)
                ->withOnBlockClickEvent('onBlockClick')
            );

        return view('livewire.column-chart')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'lineChartModel' => $lineChartModel,
                'treeChartModel' => $treeChartModel,
            ]);
    }
}
