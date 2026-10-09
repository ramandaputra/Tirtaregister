import os
import re

files = [
    'resources/views/superadmin/dashboard.blade.php',
    'resources/views/superadmin/settings/index.blade.php',
    'resources/views/superadmin/news/index.blade.php',
    'resources/views/superadmin/news/edit.blade.php',
    'resources/views/superadmin/news/create.blade.php',
    'resources/views/superadmin/logs/index.blade.php'
]

for filepath in files:
    if not os.path.exists(filepath):
        print(f'File not found: {filepath}')
        continue
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Try to extract the content inside <main>
    match = re.search(r'<main[^>]*>(.*?)</main>', content, re.DOTALL)
    if match:
        inner_content = match.group(1).strip()
        new_content = f"@extends('layouts.admin')\n\n@section('content')\n{inner_content}\n@endsection\n"
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f'Refactored: {filepath}')
    else:
        print(f'No <main> tag found in {filepath}')
