<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of tables.
     */
    public function tables()
    {
        $tables = Table::all();
        return view('tables.show_tables', compact('tables'));
    }

    /**
     * Show the form for creating a new table.
     */
    public function create()
    {
        return view('tables.create_table');
    }

    /**
     * Store a newly created table in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:tables',
            'capacity' => 'required|integer|min:1',
        ]);

        $table = new Table();
        $table->name = $request->name;
        $table->capacity = $request->capacity;
        $table->save();

        return redirect()->route('admin.tables')->with('success', 'Table added successfully!');
    }

    /**
     * Show the form for editing the specified table.
     */
    public function edit($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return redirect()->route('admin.tables')->with('error', 'Table not found');
        }

        return view('tables.update_table', compact('table'));
    }

    /**
     * Update the specified table in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:tables,name,' . $id,
            'capacity' => 'required|integer|min:1',
        ]);

        $table = Table::find($id);

        if (!$table) {
            return redirect()->route('admin.tables')->with('error', 'Table not found');
        }

        $table->name = $request->name;
        $table->capacity = $request->capacity;
        $table->save();

        return redirect()->route('admin.tables')->with('success', 'Table updated successfully!');
    }

    /**
     * Remove the specified table from storage.
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('admin.tables')->with('success', 'Table deleted successfully!');
    }
}
