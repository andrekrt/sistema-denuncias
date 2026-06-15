<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Nova denúncia registrada</title>
</head>

<body style="font-family: Arial, sans-serif; color: #111827;">
    <h2>Nova denúncia registrada</h2>

    <p>Uma nova denúncia foi registrada no Canal de Denúncias da Friobom.</p>

    <table cellpadding="6" cellspacing="0" border="0">
        <tr>
            <td><strong>Protocolo:</strong></td>
            <td>{{ $denuncia->protocolo }}</td>
        </tr>

        <tr>
            <td><strong>Tipo:</strong></td>
            <td>{{ str_replace('_', ' ', ucfirst($denuncia->tipo)) }}</td>
        </tr>

        <tr>
            <td><strong>Status:</strong></td>
            <td>{{ str_replace('_', ' ', ucfirst($denuncia->status)) }}</td>
        </tr>

        <tr>
            <td><strong>Data:</strong></td>
            <td>{{ $denuncia->created_at->format('d/m/Y H:i') }}</td>
        </tr>

        <tr>
            <td><strong>Anônima:</strong></td>
            <td>{{ $denuncia->anonima ? 'Sim' : 'Não' }}</td>
        </tr>
    </table>

    <p>
        Acesse o painel administrativo para visualizar os detalhes:
    </p>

    <p>
        <a href="{{ route('admin.denuncias.show', $denuncia) }}">
            Abrir denúncia no painel
        </a>
    </p>

    <p style="font-size: 12px; color: #6b7280;">
        Por segurança, a descrição completa da denúncia e os anexos não são enviados por e-mail.
    </p>
</body>

</html>
