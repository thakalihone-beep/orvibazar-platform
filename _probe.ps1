$paths = @('/shop', '/categories', '/cart', '/login', '/register', '/wishlist', '/sale')
foreach ($path in $paths) {
    try {
        $r = Invoke-WebRequest -Uri "http://127.0.0.1:8000$path" -UseBasicParsing -TimeoutSec 15 -MaximumRedirection 5
        Write-Output "$path => $($r.StatusCode)"
    } catch {
        $code = $_.Exception.Response.StatusCode.value__
        Write-Output "$path => ERR $code"
    }
}
