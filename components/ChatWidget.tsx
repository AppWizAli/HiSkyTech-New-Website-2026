"use client";

import { useEffect, useRef, useState } from "react";
import Image from "next/image";
import { AnimatePresence, motion } from "framer-motion";

const CHAT_URL = "https://alihamza.app.n8n.cloud/webhook/hiskytech-agent-chat/chat";
const WELCOME =
  "Hi there! 👋\nI'm the HiSkyTech assistant. Ask me about our services, or leave your details for a callback.";

type Message = { id: string; sender: "bot" | "user"; text: string; time: string };

function formatTime(date: Date) {
  return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
}

export function ChatWidget() {
  const [open, setOpen] = useState(false);
  const [messages, setMessages] = useState<Message[]>([
    { id: "welcome", sender: "bot", text: WELCOME, time: "" },
  ]);
  const [draft, setDraft] = useState("");
  const [sending, setSending] = useState(false);
  const sessionId = useRef("");
  const scroller = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const existing = window.localStorage.getItem("hiskytech-chat-session");
    const id = existing || crypto.randomUUID();
    if (!existing) window.localStorage.setItem("hiskytech-chat-session", id);
    sessionId.current = id;
    setMessages((current) =>
      current.map((message) =>
        message.id === "welcome" && !message.time
          ? { ...message, time: formatTime(new Date()) }
          : message,
      ),
    );
  }, []);

  useEffect(() => {
    scroller.current?.scrollTo({ top: scroller.current.scrollHeight, behavior: "smooth" });
  }, [messages, sending, open]);

  async function send() {
    const text = draft.trim();
    if (!text || sending) return;
    setMessages((current) => [
      ...current,
      { id: crypto.randomUUID(), sender: "user", text, time: formatTime(new Date()) },
    ]);
    setDraft("");
    setSending(true);
    try {
      const response = await fetch(CHAT_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          action: "sendMessage",
          sessionId: sessionId.current,
          chatInput: text,
        }),
      });
      const payload = (await response.json()) as {
        output?: string;
        text?: string;
        message?: string;
      };
      const reply = payload.output ?? payload.text ?? payload.message ?? "Sorry, something went wrong.";
      setMessages((current) => [
        ...current,
        { id: crypto.randomUUID(), sender: "bot", text: reply, time: formatTime(new Date()) },
      ]);
    } catch {
      setMessages((current) => [
        ...current,
        {
          id: crypto.randomUUID(),
          sender: "bot",
          text: "Sorry, I couldn't reach the server. Please try again in a moment, or email hiskytechs@gmail.com.",
          time: formatTime(new Date()),
        },
      ]);
    } finally {
      setSending(false);
    }
  }

  return (
    <div className="fixed bottom-5 right-5 z-50 flex flex-col items-end">
      <AnimatePresence>
        {open && (
          <motion.div
            initial={{ opacity: 0, y: 16, scale: 0.97 }}
            animate={{ opacity: 1, y: 0, scale: 1 }}
            exit={{ opacity: 0, y: 16, scale: 0.97 }}
            transition={{ duration: 0.18 }}
            className="mb-4 flex h-[560px] w-[380px] max-w-[calc(100vw-2.5rem)] flex-col overflow-hidden rounded-2xl border border-border-dark bg-brand-dark shadow-2xl shadow-black/50"
          >
            <div className="flex items-center justify-between border-b border-border-dark bg-card-dark px-4 py-3">
              <div className="flex items-center gap-3">
                <div className="flex h-10 w-10 items-center justify-center rounded-full bg-brand-dark ring-1 ring-border-dark">
                  <Image src="/chat-logo.png" alt="HiSkyTech" width={24} height={24} />
                </div>
                <div>
                  <p className="text-sm font-semibold text-slate-100">HiSkyTech</p>
                  <p className="text-xs text-subtle-text">AI Assistant</p>
                </div>
              </div>
              <div className="flex items-center gap-3">
                <span className="flex items-center gap-1.5 text-xs text-subtle-text">
                  <span className="h-2 w-2 rounded-full bg-emerald-400" />
                  Online
                </span>
                <button
                  type="button"
                  onClick={() => setOpen(false)}
                  aria-label="Close chat"
                  className="text-subtle-text transition-colors hover:text-slate-100"
                >
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6 6 18M6 6l12 12" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
                  </svg>
                </button>
              </div>
            </div>
            <div ref={scroller} className="flex-1 space-y-4 overflow-y-auto px-4 py-4">
              {messages.map((message) => (
                <div
                  key={message.id}
                  className={`flex items-end gap-2 ${message.sender === "user" ? "flex-row-reverse" : ""}`}
                >
                  {message.sender === "bot" && (
                    <div className="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-card-dark ring-1 ring-border-dark">
                      <Image src="/chat-logo.png" alt="" width={16} height={16} />
                    </div>
                  )}
                  <div className="flex max-w-[78%] flex-col gap-1">
                    <div
                      className={`whitespace-pre-line rounded-2xl px-4 py-2.5 text-sm leading-relaxed ${
                        message.sender === "user"
                          ? "rounded-br-sm bg-electric-blue text-white"
                          : "rounded-bl-sm bg-card-dark text-slate-100"
                      }`}
                    >
                      {message.text}
                    </div>
                    {message.time && (
                      <span
                        className={`text-[11px] text-subtle-text ${message.sender === "user" ? "text-right" : ""}`}
                      >
                        {message.time}
                      </span>
                    )}
                  </div>
                </div>
              ))}
              {sending && (
                <div className="flex items-end gap-2">
                  <div className="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-card-dark ring-1 ring-border-dark">
                    <Image src="/chat-logo.png" alt="" width={16} height={16} />
                  </div>
                  <div className="flex items-center gap-1 rounded-2xl rounded-bl-sm bg-card-dark px-4 py-3">
                    {[0, 1, 2].map((dot) => (
                      <span
                        key={dot}
                        className="h-1.5 w-1.5 animate-bounce rounded-full bg-subtle-text"
                        style={{ animationDelay: `${0.15 * dot}s` }}
                      />
                    ))}
                  </div>
                </div>
              )}
            </div>
            <div className="border-t border-border-dark bg-card-dark p-3">
              <div className="flex items-center gap-2 rounded-full border border-border-dark bg-brand-dark px-4 py-2">
                <input
                  value={draft}
                  onChange={(event) => setDraft(event.target.value)}
                  onKeyDown={(event) => {
                    if (event.key === "Enter") send();
                  }}
                  placeholder="Type your message..."
                  className="flex-1 bg-transparent text-sm text-slate-100 placeholder:text-subtle-text focus:outline-none"
                />
                <button
                  type="button"
                  onClick={send}
                  disabled={!draft.trim() || sending}
                  aria-label="Send message"
                  className="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-electric-blue text-white transition-opacity disabled:opacity-40"
                >
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path
                      d="M22 2 11 13M22 2l-7 20-4-9-9-4 20-7Z"
                      stroke="currentColor"
                      strokeWidth="2"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
      <div className="relative">
        <AnimatePresence>
          {!open && (
            <motion.div
              initial={{ opacity: 0, x: 8, scale: 0.9 }}
              animate={{ opacity: 1, x: 0, scale: 1 }}
              exit={{ opacity: 0, x: 8, scale: 0.9 }}
              transition={{ duration: 0.25, delay: 0.4 }}
              style={{ position: "absolute", right: "4.5rem", bottom: "0.75rem" }}
              className="flex items-center gap-1.5 whitespace-nowrap rounded-full border border-border-dark bg-card-dark px-4 py-2.5 text-sm font-medium text-slate-100 shadow-lg shadow-black/40"
            >
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" className="text-electric-blue">
                <path d="M12 2 13.8 8.2 20 10 13.8 11.8 12 18 10.2 11.8 4 10 10.2 8.2 12 2Z" />
              </svg>
              Chat with HiSkyTech
              <span
                style={{ position: "absolute", right: "-6px", bottom: "12px" }}
                className="h-3 w-3 rotate-45 border-r border-b border-border-dark bg-card-dark"
              />
            </motion.div>
          )}
        </AnimatePresence>
        <motion.button
          type="button"
          whileTap={{ scale: 0.94 }}
          onClick={() => setOpen((value) => !value)}
          aria-label={open ? "Close chat" : "Open chat"}
          className="relative flex h-16 w-16 items-center justify-center rounded-full text-white"
        >
          {!open && (
            <motion.span
              className="absolute inset-0 rounded-full bg-electric-blue"
              animate={{ opacity: [0.5, 0, 0.5], scale: [1, 1.35, 1] }}
              transition={{ duration: 2.4, repeat: Infinity, ease: "easeInOut" }}
            />
          )}
          <span
            className="absolute inset-0 rounded-full"
            style={{
              background: "radial-gradient(circle at 35% 30%, #60a5fa, #2563eb 60%, #1d4ed8 100%)",
              boxShadow: "0 0 24px 4px rgba(37,99,235,0.55), 0 4px 18px rgba(0,0,0,0.45)",
            }}
          />
          <span className="relative z-10">
            {open ? (
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6 6 18M6 6l12 12" stroke="currentColor" strokeWidth="2" strokeLinecap="round" />
              </svg>
            ) : (
              <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <rect x="3.5" y="9" width="4" height="6" rx="1.5" fill="currentColor" opacity="0.9" />
                <rect x="16.5" y="9" width="4" height="6" rx="1.5" fill="currentColor" opacity="0.9" />
                <rect x="6.5" y="6" width="11" height="12" rx="4" fill="currentColor" />
                <circle cx="12" cy="4" r="1.3" fill="currentColor" />
                <line x1="12" y1="5.3" x2="12" y2="6.8" stroke="currentColor" strokeWidth="1.3" />
                <circle cx="9.7" cy="12" r="1.2" fill="#0e0e12" />
                <circle cx="14.3" cy="12" r="1.2" fill="#0e0e12" />
                <path d="M9.5 15h5" stroke="#0e0e12" strokeWidth="1.3" strokeLinecap="round" />
              </svg>
            )}
          </span>
        </motion.button>
      </div>
    </div>
  );
}
