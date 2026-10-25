#!/usr/bin/env python3
"""Build includes/geo/<cc>.bin from the free ipdeny.com country zone lists.

usage: python3 tools/build-geo-ranges.py pk in [more country codes...]

Each .bin is a sorted list of 32-byte records (16-byte start, 16-byte end, IPv6 form; IPv4 is stored
IPv4-mapped ::ffff:a.b.c.d) that includes/functions.php binary-searches on every request.
Re-run now and then (ranges change) and commit the new files.
"""
import ipaddress, os, subprocess, sys, pathlib

OUT = pathlib.Path(__file__).resolve().parent.parent / 'includes' / 'geo'
OUT.mkdir(parents=True, exist_ok=True)
SOURCES = ['https://www.ipdeny.com/ipblocks/data/aggregated/{cc}-aggregated.zone',
           'https://www.ipdeny.com/ipv6/ipaddresses/aggregated/{cc}-aggregated.zone']

def to16(addr):
    return (b'\x00' * 10 + b'\xff\xff' + addr.packed) if addr.version == 4 else addr.packed

for cc in [c.lower() for c in sys.argv[1:]] or ['pk', 'in']:
    ranges = []
    for src in SOURCES:
        # curl uses the OS certificate store (python's urllib often lacks it on macOS)
        txt = subprocess.run(['curl', '-fsS', '-m', '60', src.format(cc=cc)], capture_output=True, text=True, check=True).stdout
        for line in txt.split():
            net = ipaddress.ip_network(line.strip(), strict=False)
            ranges.append((to16(net.network_address), to16(net.broadcast_address if net.version == 4 else net[-1])))
    ranges.sort()
    (OUT / f'{cc}.bin').write_bytes(b''.join(s + e for s, e in ranges))
    print(cc, len(ranges), 'ranges')
