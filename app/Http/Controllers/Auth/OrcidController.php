<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use SocialiteProviders\Orcid\Provider;
use SocialiteProviders\Manager\Config;


class OrcidController extends Controller
{
    // Step 1: redirect user to ORCID login page
public function redirect()
{
 $query = http_build_query([
        'client_id' => config('services.orcid.client_id'),
        'response_type' => 'code',
        'scope' => '/authenticate',
        'redirect_uri' => config('services.orcid.redirect'),
    ]);

    return redirect('https://orcid.org/oauth/authorize?' . $query);}



public function callback(Request $request)
{
    // 1️⃣ Exchange code for access token
    $response = Http::asForm()->post('https://orcid.org/oauth/token', [
        'client_id' => config('services.orcid.client_id'),
        'client_secret' => config('services.orcid.client_secret'),
        'grant_type' => 'authorization_code',
        'code' => $request->code,
        'redirect_uri' => config('services.orcid.redirect'),
    ]);

    $data = $response->json();
    $token = $data['access_token'];
    $orcidId = $data['orcid'];

    // 2️⃣ Fetch ORCID profile
    $profile = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
    ])->get("https://pub.orcid.org/v3.0/{$orcidId}")->json();

    // 3️⃣ Find or create user
    $user = User::updateOrCreate(
        ['orcid_id' => $orcidId], // search by ORCID ID
        [
            'name' => $profile['person']['name']['given-names']['value'] ?? 'No Name',
            'email' => $profile['person']['emails']['email'][0]['email'] ?? Str::slug($orcidId).'@orcid.org',
            'password' => bcrypt(Str::random(16)), // random password for ORCID login
        ]
    );

    // 4️⃣ Log the user in
    Auth::login($user);

    // 5️⃣ Redirect wherever you want
    return redirect()->route('home')->with('success', 'Logged in with ORCID!');
}

}
