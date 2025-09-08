 <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-puzzle-piece text-purple-600"></i>
            Komponen Evaluasi
          </h3>
          <a href="{{ route('component.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Komponen
          </a>
        </div>

        <div class="table-container overflow-auto xl:overflow-hidden">
          <table class="min-w-full" id="components">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Kriteria</th>
                <th class="text-left">Nama Komponen</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              @php
                // Group by criteria_id
                $groupedComponents = $evalcomponents
                // Sort all components by criteria_id first
                ->sortBy('criteria_id')

                // Group them by criteria_id
                ->groupBy('criteria_id')

                // Sort the groups by the criteria_id key
                ->sortKeys()

                // Sort inside each group too
                ->map(function ($group) {
                    return $group->sortBy('criteria_id');
                });


              $no = 1;
              @endphp

              @foreach($groupedComponents as $criteriaId => $evalcomponentsGroup)
                @php
                  $criteria = $evalcomponentsGroup->first()->criteria;

                  // Extract colors from style
                  preg_match_all('/#([0-9a-fA-F]{6})/', $criteria->style, $matches);
                  $primaryColor = $matches[0][0] ?? '#000000';
                  $secondaryColor = $matches[0][1] ?? '#000000';

                  // Background RGBA with 0.1 opacity
                  list($r, $g, $b) = sscanf($primaryColor, "#%02x%02x%02x");
                  $bgColor = "rgba($r, $g, $b, 0.1)";
                @endphp

                  @foreach($evalcomponentsGroup as $data)
                    <tr class="table-row">
                      <td class="p-6">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm"
                          style="background: {{ $primaryColor }};">
                          {{ $no++ }}
                        </div>
                      </td>
                      <td class="p-6">
                        <div class="criteria-badge px-3 py-1 rounded-lg font-semibold text-xs"
                          style="color: {{ $secondaryColor }}; background-color: {{ $bgColor }};">
                          {{ strtoupper($criteria->name) }}
                        </div>
                      </td>
                      <td class="p-6 min-w-60">
                        <div class="component-name font-semibold">{{ $data->name }}</div>
                        <div class="component-description text-sm text-gray-500">{{ $data->description }}</div>
                      </td>
                      <td class="p-6 text-center">
                        <div class="weight-badge px-3 py-1 rounded-lg font-semibold text-white"
                          style="background: {{ $criteria->style }};">
                          <i class="fas fa-percentage"></i>
                          {{ $data->weight }}%
                        </div>
                      </td>
                      <td class="p-6 text-center">
                        <div class="flex justify-center space-x-2">
                          <a href="{{ route('component.edit', ["id" => $data->id]) }}" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <form action="{{ route('component.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn"
                              onclick="return confirm('Are you sure you want to delete this component?')">
                              <i class="fas fa-trash"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endforeach
            </tbody>
          </table>
        </div>
