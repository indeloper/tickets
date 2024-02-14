<?php

namespace App\Builders;

use App\Models\Ticket as Model;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as Collection;

/**
 * @method Model getModel()
 * @method Model make(array $attributes = [])
 * @method Model create(array $attributes = [])
 * @method Model sole($columns = ['*'])
 * @method Model find($id, $columns = ['*'])
 * @method Model findOr($id, $columns = ['*'], Closure $callback = null)
 * @method Model findOrNew($id, $columns = ['*'])
 * @method Model findOrFail($id, $columns = ['*'])
 * @method Model first($columns = ['*'])
 * @method Model firstOr($columns = ['*'], Closure $callback = null)
 * @method Model firstOrNew(array $attributes = [], array $values = [])
 * @method Model firstOrFail($columns = ['*'])
 * @method Model firstOrCreate(array $attributes = [], array $values = [])
 * @method Model firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method Model forceCreate(array $attributes)
 * @method Model updateOrCreate(array $attributes, array $values = [])
 *
 * @method Collection|Model[] findMany($ids, $columns = ['*'])
 * @method Collection|Model[] get($columns = ['*'])
 */
class TicketBuilder extends Builder
{
    public function whereByUser(User $user): static
    {
        return $this;
    }
}
