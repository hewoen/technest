<div class="container mt-1">
    <div class="d-flex justify-content-between">
        <!-- Step 1 -->
        <div class="step">
            <div class="circle {{ $step>=1 ? "active" : "" }}">1</div>
            <div class="text-center mt-2">Kundeninformationen</div>
        </div>
        <!-- Step 2 -->
        <div class="step">
            <div class="circle {{ $step>=2 ? "active" : "" }}">2</div>
            <div class="text-center mt-2">Bestellübersicht</div>
        </div>
        <!-- Step 3 -->
        <div class="step">
            <div class="circle {{ $step>=3 ? "active" : "" }}">3</div>
            <div class="text-center mt-2">Zahlung</div>
        </div>
        <!-- Step 4 -->
        <div class="step">
            <div class="circle {{ $step>=4 ? "active" : "" }}">4</div>
            <div class="text-center mt-2">Abschluss</div>
        </div>
    </div>
</div>