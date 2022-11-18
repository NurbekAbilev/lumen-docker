<?php

namespace App\Queries;
use App\Models\Company;
use App\Queries\Contracts\CompanyQueryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CompanyQuery implements CompanyQueryContract
{
	public function getAll(Request $request): Collection
    {
        return Company::query()
            ->when($request->input('title'), function(Builder $builder) use ($request) {
                $builder->where('title', 'like', "%{$request->input('title')}%");
            })
            ->when($request->input('phone'), function(Builder $builder) use ($request) {
                $builder->where('phone', 'like', "%{$request->input('phone')}%");
            })
            ->when($request->input('description'), function(Builder $builder) use ($request) {
                $builder->where('description', 'like', "%{$request->input('description')}%");
            })
            ->where('user_id', $request->user()->id)
            ->get();
	}
}
