<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Team;
use App\Models\Circuit;
use App\Models\Season;
use App\Models\Race;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    /**
     * Toggle favorite status for a model.
     *
     * @param string $model The model type (driver, team, circuit, season, race)
     * @param int $id The model ID
     * @return JsonResponse
     */
    public function toggle(string $model, int $id): JsonResponse
    {
        // Ensure user is authenticated
        $user = Auth::user();
        if (!$user) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Unauthorized",
                ],
                401,
            );
        }

        // Get the model instance
        $modelInstance = $this->getModel($model, $id);
        if (!$modelInstance) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Model not found",
                ],
                404,
            );
        }

        // Get the model class name for the polymorphic relationship
        $modelClass = get_class($modelInstance);

        // Check if favorite already exists
        $favorite = Favorite::where("user_id", $user->id)
            ->where("favoritable_type", $modelClass)
            ->where("favoritable_id", $modelInstance->id)
            ->first();

        if ($favorite) {
            // Remove favorite
            $favorite->delete();
            $isFavorited = false;
        } else {
            // Add favorite
            Favorite::create([
                "user_id" => $user->id,
                "favoritable_type" => $modelClass,
                "favoritable_id" => $modelInstance->id,
            ]);
            $isFavorited = true;
        }

        return response()->json([
            "success" => true,
            "is_favorited" => $isFavorited,
            "message" => $isFavorited
                ? "Added to favorites"
                : "Removed from favorites",
        ]);
    }

    /**
     * Get the model instance based on the type and ID.
     *
     * @param string $model The model type
     * @param int $id The model ID
     * @return mixed The model instance or null
     */
    private function getModel(string $model, int $id)
    {
        $modelLower = strtolower($model);

        switch ($modelLower) {
            case "driver":
                return Driver::find($id);
            case "team":
                return Team::find($id);
            case "circuit":
                return Circuit::find($id);
            case "season":
                return Season::find($id);
            case "race":
                return Race::find($id);
            default:
                return null;
        }
    }
}
