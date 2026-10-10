import urllib.request
import json

res = urllib.request.urlopen('http://localhost:8000/api/kegiatan')
data = json.loads(res.read().decode('utf-8'))
print(f"Total activities returned from API: {len(data)}")

for item in data:
    img_url = 'http://localhost:8000' + item['gambar_url']
    try:
        with urllib.request.urlopen(img_url) as r:
            size = len(r.read())
            print(f"[{item['id']}] {item['tanggal']} | {item['judul'][:45]} | Img OK ({size} bytes)")
    except Exception as e:
        print(f"[{item['id']}] {item['tanggal']} | FAILED: {img_url} -> {e}")
