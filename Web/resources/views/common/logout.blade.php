<form id="logout-form-common" action="{{ URL_LOGOUT }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
<script type="text/javascript">
	document.getElementById('logout-form-common').submit();
</script>