<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Deprecated(
        reason: 'Use LiveWire validation in TicketForm.',
        replacement: 'submitForm(false, %parameter0%)')
    ]
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['required'],
        ]);

        $fields = Category::find($request->category_id)->inputs;
        $data = [];
        $rules = [];

        foreach ($fields as $field) {
            $data[$field] = $request->get($field);
            $rule = [];

            if ($field->is_required) {
                $rule[] = 'required';
            }

            // Add type-specific rules
            switch ($field->field_type) {
                case 'textarea':
                case 'text':
                    $rule[] = 'string';
                    break;
                case 'select':
                case 'radio':
                    $rule[] = 'in:' . implode(',', json_decode($field->options, true));
                    break;
                case 'checkbox':
                    $rule[] = 'array';
                    break;
                default:
                    $rule[] = 'nullable'; // Allow other types to be empty
                    break;
            }

            // Assign the rule to the field name
            $rules[$field->field_name] = implode('|', $rule);
        }

        $request->validate($rules);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            "subject" => $request->subject,
            "category_id" => $request->category_id,
            "description" => $request->description,
            "custom_data" => $data,
        ]);

        return to_route('tickets.show', $ticket->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
