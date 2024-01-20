<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopikRequest;
use App\Http\Requests\UpdateTopikRequest;
use App\Models\Topik;
use Illuminate\Http\Request;

class TopikController extends Controller
{
    public function index()
    {
        $topiks = Topik::all();
        return view('topik.index', ['topik' => $topiks]);
    }

    public function create()
    {
        return view('topik.create');
    }

    public function store(StoreTopikRequest $request)
    {
        $params = $request->validated();
        $params['tp_status'] = 1;
        $topik = Topik::create($params);

        if ($topik) {
            return redirect(route('topik.index'))->with('success', 'Added!');
        } else {
            return redirect(route('topik.index'))->with('error', 'Failed to add topik.');
        }
    }

    public function edit($id)
    {
        $topik = Topik::findOrFail($id);
        return view('topik.edit', ['topik' => $topik]);
    }

    public function update(UpdateTopikRequest $request, $id)
    {
        $topik = Topik::findOrFail($id);
        $params = $request->validated();

        // Update topik data
        if ($topik->update($params)) {
            return redirect(route('topik.index'))->with('success', 'Updated!');
        } else {
            return redirect(route('topik.index'))->with('error', 'Failed to update topik.');
        }
    }

    public function destroy($id)
    {
        $topik = Topik::findOrFail($id);

        $topik->update(['tp_status' => '0']);

        return redirect(route('topik.index'))->with('success', 'Topik marked as inactive!');
    }
}
