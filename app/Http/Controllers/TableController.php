<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of all tables.
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
     * Store a newly created table in the database.
     */
    public function store(Request $request)
    {
        // Custom validation messages for unique constraint
        $messages = [
            'table_number.unique' => 'The table number already exists. Please choose a different one.',
        ];

        // Validate input fields
        $request->validate([
            'table_number' => 'required|string|max:10|unique:tables,table_number',
            'hall' => 'required|string|max:255',
            'is_reserved' => 'required|boolean',
        ], $messages);

        // Create the table if validation passes
        Table::create($request->all());

        // Redirect to tables list with a success message
        return redirect()->route('admin.tables')->with('message', 'Table added successfully');
    }

    /**
     * Update the reserved status of a table.
     */
    public function updateReservedStatus(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'is_reserved' => 'required|boolean',
        ]);

        $table = Table::findOrFail($request->table_id);
        $table->update($request->all());

        return redirect()->route('admin.tables')->with('message', 'Table reserved status updated successfully.');
    }

    /**
     * Show the form for editing the specified table.
     */
    public function edit($id)
    {
        $table = Table::findOrFail($id);
        return view('tables.update_table', compact('table'));
    }

    /**
     * Update the specified table in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'table_number' => 'required|string|max:10',
            'hall' => 'required|string|max:255',
            'is_reserved' => 'required|boolean',
        ]);

        $table = Table::findOrFail($id);
        $table->update($request->all());

        return redirect()->route('admin.tables')->with('message', 'Table updated successfully');
    }

    /**
     * Remove the specified table from the database.
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('admin.tables')->with('message', 'Table deleted successfully');
    }
}
