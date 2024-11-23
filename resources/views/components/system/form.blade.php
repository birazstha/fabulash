<form action="{{ $action }}" method="GET">
    <div class="input-group input-group-sm">
        {{ $inputs }}
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
        <a href="{{ $action }}" class="btn btn-success btn-sm ml-1"><i class="fas fa-recycle"></i></a>
    </div>
</form>
