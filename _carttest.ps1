$sess = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$homePage = Invoke-WebRequest -Uri "http://127.0.0.1:8000/" -WebSession $sess -UseBasicParsing -TimeoutSec 15
$token = [regex]::Match($homePage.Content, 'csrf-token" content="([^"]+)"').Groups[1].Value

$productId = php artisan tinker --execute "echo App\Models\Product::where('status', 'published')->first()?->id ?? '0';"
Write-Output "productId=$productId"

$headers = @{
    'X-CSRF-TOKEN'    = $token
    'X-Requested-With' = 'XMLHttpRequest'
    'Accept'           = 'application/json'
}

$addBody = @{ product_id = [int]$productId; quantity = 1 }
try {
    $add = Invoke-WebRequest -Uri "http://127.0.0.1:8000/cart/add" -Method POST -Body $addBody -Headers $headers -WebSession $sess -UseBasicParsing -TimeoutSec 15
    Write-Output "cart add => HTTP $($add.StatusCode) :: $($add.Content)"
} catch {
    Write-Output "cart add => ERR $($_.Exception.Response.StatusCode.value__)"
}

# Now test remove with the fixed URL
try {
    $remove = Invoke-WebRequest -Uri "http://127.0.0.1:8000/cart/remove/$productId" -Method DELETE -Headers $headers -WebSession $sess -UseBasicParsing -TimeoutSec 15
    Write-Output "cart remove => HTTP $($remove.StatusCode) :: $($remove.Content)"
} catch {
    Write-Output "cart remove => ERR $($_.Exception.Response.StatusCode.value__)"
}
