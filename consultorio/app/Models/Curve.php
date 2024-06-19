namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curve extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'curve_type', 'proximal_limit', 'distal_limit', 'angle', 'structured'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
