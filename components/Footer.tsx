"use client";

import Image from "next/image";
import { navLinks } from "@/lib/content";
import { EMAIL, LOCATION_LONG, PHONE_DISPLAY, WHATSAPP_URL } from "@/lib/site";

export function Footer() {
  return (
    <footer className="border-t border-white/[0.06] py-12 bg-[#040406]">
      <div className="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div className="flex flex-col items-center md:items-start">
          <Image
            src="/logo.webp"
            alt="HiSkyTech"
            width={1206}
            height={252}
            className="h-6 w-auto"
          />
          <div className="text-xs text-neutral-500 font-mono mt-2">
            AI Automation • AI Calling Agents • Mobile Apps • Web Development
          </div>
          <div className="text-xs text-neutral-500 mt-1.5">{LOCATION_LONG}</div>
          <div className="flex flex-wrap items-center justify-center md:justify-start gap-x-4 gap-y-1 mt-2 text-xs">
            <a className="text-neutral-300 hover:text-white" href={`mailto:${EMAIL}`}>
              {EMAIL}
            </a>
            <a
              className="text-neutral-300 hover:text-white"
              href={WHATSAPP_URL}
              target="_blank"
              rel="noopener noreferrer"
            >
              {PHONE_DISPLAY}
            </a>
          </div>
        </div>
        <div className="flex flex-wrap items-center justify-center gap-6 text-xs text-neutral-400">
          {navLinks.map((link) => (
            <a key={link.href} href={link.href} className="hover:text-white transition-colors">
              {link.label}
            </a>
          ))}
        </div>
        <div className="flex items-center gap-4 text-xs text-neutral-500">
          <span>© {new Date().getFullYear()} HiSkyTech. All rights reserved.</span>
          <button
            type="button"
            onClick={() => window.scrollTo({ top: 0, behavior: "smooth" })}
            className="hover:text-white transition-colors flex items-center gap-1"
          >
            <span>Back to top</span>
            <span>↑</span>
          </button>
        </div>
      </div>
    </footer>
  );
}
