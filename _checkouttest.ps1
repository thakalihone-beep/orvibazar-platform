$sess = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$homePage = Invoke-WebRequest -Uri "http://127.0.0.1:8000/products/casio-a158wa-series-unisex-digital-watch-vintage-wr-100-sec-stop-watch-daily-alarm-regular-time-keeping-hour-minute-second-pm-date-day-led-light-7-yr-battery" -WebSession $sess -UseBasicParsing -TimeoutSec 15
$token = [regex]::Match($homePage.Content, 'csrf-token" content="([^"]+)"').Groups[1].Value
$body = @{ _token = $token; product_id = 2; quantity = 1 }
try {
    $resp = Invoke-WebRequest -Uri "http://127.0.0.1:8000/checkout/now" -Method POST -Body $body -WebSession $sess -UseBasicParsing -TimeoutSec 15 -MaximumRedirection 0
    Write-Output "checkout/now => HTTP $($resp.StatusCode)"
} catch {
    $code = $_.Exception.Response.StatusCode.value__
    Write-Output "checkout/now => ERR $code"
}
