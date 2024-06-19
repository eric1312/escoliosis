
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'risser', 'shoulder_balance'];

    public function curves()
    {
        return $this->hasMany(Curve::class);
    }

    public function treatment()
    {
        return $this->hasOne(Treatment::class);
    }
}
