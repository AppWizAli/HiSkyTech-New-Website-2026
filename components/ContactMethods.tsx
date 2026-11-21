import {
  CALENDLY_URL,
  EMAIL,
  LOCATION,
  PHONE_DISPLAY,
  WHATSAPP_URL,
  bookCallHref,
  mailtoHref,
} from "@/lib/site";

const buttonClass =
  "inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full font-semibold text-sm transition-all";

export function BookCallButton({ className = "" }: { className?: string }) {
  const placeholder = !CALENDLY_URL;
  return (
    <a
      className={`${buttonClass} bg-transparent hover:bg-white/[0.05] text-white border border-white/10 ${className}`}
      href={bookCallHref()}
      {...(placeholder
        ? {}
        : { target: "_blank", rel: "noopener noreferrer" })}
    >
      Book a call <span>→</span>
    </a>
  );
}

export function ContactMethods({ compact = false }: { compact?: boolean }) {
  return (
    <ul className={`grid gap-3 text-left ${compact ? "" : "sm:grid-cols-3"}`}>
      <li className="rounded-xl border border-white/[0.08] bg-white/[0.03] px-4 py-3">
        <div className="text-[10px] uppercase tracking-wider font-mono text-neutral-500 mb-1">
          Email
        </div>
        <a className="text-sm text-white hover:text-blue-400 break-all" href={mailtoHref()}>
          {EMAIL}
        </a>
      </li>
      <li className="rounded-xl border border-white/[0.08] bg-white/[0.03] px-4 py-3">
        <div className="text-[10px] uppercase tracking-wider font-mono text-neutral-500 mb-1">
          WhatsApp
        </div>
        <a
          className="text-sm text-white hover:text-blue-400"
          href={WHATSAPP_URL}
          target="_blank"
          rel="noopener noreferrer"
        >
          {PHONE_DISPLAY}
        </a>
      </li>
      <li className="rounded-xl border border-white/[0.08] bg-white/[0.03] px-4 py-3">
        <div className="text-[10px] uppercase tracking-wider font-mono text-neutral-500 mb-1">
          Location
        </div>
        <div className="text-sm text-white">{LOCATION}</div>
      </li>
    </ul>
  );
}
