<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rrt_reporttypeid
 * @property string $rrt_reportvalue
 * @property string $rrt_reporticon
 * @property int $rrt_criticallevel
 * @property string $rrt_reporttypestamp
 * @property TReportQuery[] $tReportQueries
 */
class r_report_type extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rrt_reporttypeid';

    /**
     * @var array
     */
    protected $fillable = ['rrt_reportvalue', 'rrt_reporticon', 'rrt_criticallevel', 'rrt_reporttypestamp'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tReportQueries()
    {
        return $this->hasMany(t_report_queries::class, 'trq_reporttype', 'rrt_reporttypeid');
    }
}
