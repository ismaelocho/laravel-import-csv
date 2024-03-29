<div>
    <div class="container mx-auto space-y-4 p-4 sm:p-0 mt-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                <livewire:livewire-column-chart
                    key="{{ $columnChartModel->reactiveKey() }}"
                    :column-chart-model="$columnChartModel"
                />
            </div>

            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                <livewire:livewire-pie-chart
                    key="{{ $pieChartModel->reactiveKey() }}"
                    :pie-chart-model="$pieChartModel"
                />
            </div>
        </div>
    </div>
    <div class="container mx-auto space-y-4 p-4 sm:p-0 mt-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
                <livewire:livewire-line-chart
                    key="{{ $lineChartModel->reactiveKey() }}"
                    :line-chart-model="$lineChartModel"
                />
            </div>

            <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
            <livewire:livewire-tree-map-chart
                key="{{ $treeChartModel->reactiveKey() }}"
                :tree-map-chart-model="$treeChartModel"
            />
            </div>
        </div>
    </div>
</div>